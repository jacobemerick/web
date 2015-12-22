<?

Loader::load('controller', 'portfolio/DefaultPageController');
Loader::load('utility', 'ImageOld');

final class PieceController extends DefaultPageController
{

	private $title_url;

	function __construct()
	{
		parent::__construct();
		
		$this->title_url = URLDecode::getPiece(2);
	}

	protected function set_data()
	{
		$this->set_title("Jacob Emerick's Portfolio");
		$this->set_head('description', "Jacob Emerick's Portfolio - examples of my work ranging from early print design to current web projects");
		$this->set_head('keywords', 'portfolio, Jacob Emerick, print design, examples, advertising, marketing campaigns, freelance, graphic design');
		
		$this->set_body('body_view', 'Piece');
		$this->set_body('left_side_data', array(
			'title' => "Print Gallery | Jacob Emerick's Portfolio",
			'menu' => $this->get_menu(),
			'home_link' => Loader::getRootURL()));
		$this->set_body('body_data', $this->get_piece_data());
		
		$this->set_body_view('Page');
	}

	private function get_piece_data()
	{
		Loader::load('collector', 'portfolio/PortfolioCollector');
		$portfolio_result = PortfolioCollector::getPieceByURI($this->title_url);
		
		if($portfolio_result === null)
			$this->eject();
		
		$portfolio_image_result = PortfolioCollector::getImagesForPiece($portfolio_result->id, 2);
		$image = new ImageOld("portfolio/{$portfolio_image_result[0]->name}");
		
		$main_image = new stdclass();
		$main_image->id = $portfolio_image_result[0]->id;
		$main_image->link = "/{$portfolio_image_result[0]->name}";
		
		$dimensions = $image->getDimensions();
		
		$main_image->width = $dimensions[0];
		$main_image->height = $dimensions[1];
		
		foreach($portfolio_image_result as $portfolio_image)
		{
			$thumb = $portfolio_image->name;
			$thumb_array = explode('.', $thumb);
			$thumb = "{$thumb_array[0]}_clip.{$thumb_array[1]}";
			$image = new ImageOld("portfolio/{$thumb}");
			
			$image_obj = new stdclass();
			$image_obj->id = $portfolio_image->id;
			$image_obj->link = "/{$thumb}";
			
			$dimensions = $image->getDimensions();
			
			$image_obj->width = $dimensions[0];
			$image_obj->height = $dimensions[1];
			
			$image_array[] = $image_obj;
		}
		
		$portfolio_tag_result = PortfolioCollector::getTagsForPiece($portfolio_result->id);
		
		foreach($portfolio_tag_result as $portfolio_tag)
		{
			$tag_array[] = $portfolio_tag->name;
		}
		
		return array(
			'title' => $portfolio_result->title,
			'description' => $portfolio_result->description,
			'thumbs' => $image_array,
			'image' => $main_image,
			'tags' => $tag_array);
	}

}