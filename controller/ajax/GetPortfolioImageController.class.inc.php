<?

Loader::load('collector', 'portfolio/PortfolioCollector');
Loader::load('controller', '/AJAXController');

final class GetPortfolioImageController extends AJAXController
{

	protected function set_data()
	{
		$id = Request::getPost('portfolio_id');
		
		$portfolio_result = PortfolioCollector::getImageById($id);

    $image_path = "portfolio/{$portfolio_result->name}";
    $image_path = Loader::getImagePath('image', $image_path);
    $image_size = getimagesize($image_path);

		$main_image = new stdclass();
		$main_image->id = $portfolio_result->id;
		$main_image->link = "/image/portfolio/{$portfolio_result->name}";
		
		$main_image->width = $image_size[0];
		$main_image->height = $image_size[1];
		
		$this->set_response($main_image, 'image');
		return true;
	}

}
