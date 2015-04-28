<?php namespace LebaneseTweets;

use Illuminate\Database\Eloquent\Model;
use \LebaneseTweets\Utilities\Scraper;
use \iMagick;
use \LebaneseTweets\Utilities\Url;

class Link extends Model {

	public function build($url){



		// first, make sure url exists and we can access it
		$valid = new Url($url);
		if ($valid->isValid()) {
			# proceed
		}else{
			return false;
		}

		$info = new Scraper($url);

		if ($info->getTitle()) {

			$this->url = $url;
			
			$this->title = $info->getTitle();
			
			if ($info->getDescription()) {
				$this->excerpt = $info->getDescription();
			}
			
			if ($image = $info->getImage()) {
				$header = get_headers($image, 1);
				echo "Checking if $image Exists \n"; 
				if (strpos($header[0], '404')) {
					echo "Nope. It doesn't\n";
				}else{
					$image = $info->getImage();
					$dimensions = getimagesize($image);
					$height = $dimensions[1];
					$width = $dimensions[0];
					#Cache
					$imageName = md5($image) . '.jpg';
					$directory = public_path() . '/img/cache/';
					$destination = $directory . $imageName;
					$imagick = new iMagick($image);
					$imagick->thumbnailImage(278,0);
					$imagick->writeImage($destination);

					$this->image = '/img/cache/' . $imageName;
					$this->image_width = 278;
					$this->image_height = round(278 * ($height / $width));
				}

			}
			$this->save();
		}
	}

}
