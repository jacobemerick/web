<?

Loader::load('collector', 'portfolio/PortfolioCollector');
Loader::load('controller', '/AJAXController');
Loader::load('utility', 'ImageOld');

final class GetPortfolioImageController extends AJAXController
{

	protected function set_data()
	{
		$id = Request::getPost('portfolio_id');
		
		$portfolio_result = PortfolioCollector::getImageById($id);
		$image = new ImageOld("portfolio/{$portfolio_result->name}");
		
		$main_image = new stdclass();
		$main_image->id = $portfolio_result->id;
		$main_image->link = "/{$portfolio_result->name}";
		
		$dimensions = $image->getDimensions();
		
		$main_image->width = $dimensions[0];
		$main_image->height = $dimensions[1];
		
		$this->set_response($main_image, 'image');
		return true;
	}

}