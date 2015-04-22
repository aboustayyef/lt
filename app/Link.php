<?php namespace LebaneseTweets;

use Illuminate\Database\Eloquent\Model;
use \LebaneseTweets\Utilities\SimpleScraper;
use \iMagick;

class Link extends Model {

	public function build($url){
		$info = new SimpleScraper($url);
		if ($info->getTitle()) {

			$this->url = $url;
			
			$this->title = $info->getTitle();
			
			if ($info->getDescription()) {
				$this->excerpt = $info->getDescription();
			}
			
			if ($info->getImage()) {
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
			$this->save();
		}
	}

}
