<?php

namespace Traits;

trait RedirectableControllerTrait {

	/**
	 * @return \Capstone\Di\DiInterface
	 */
	abstract public function getDi();

	protected function redirect( $url ) {
		/**
		 * @var \Capstone\HTTP\Utils\Fulfillment $fulfillment
		 * @var \Capstone\Stubs\LayoutWidget     $layout
		 */
		$fulfillment = $this->getDi()->get("fulfillment");
		$layout      = $this->getDi()->raw("layout");

		$layout->setLayout("index.cli.php");
		$fulfillment->setRedirect($url);

		return function () use ($url) {
			echo "Redirecting to: {$url}";
		};
	}
}
