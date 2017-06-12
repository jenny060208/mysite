<?php

namespace NeoWeb\Common\Common;

// This file holds the class of business account information class set
/**
 * Enter description here ...
 *
 * @author jazwang
 *        
 */
class ProductInfoSet {
	private $productName;
	private $setUpFee;
	private $monthlyFee;
	private $productDetail;
	
	// Construct function
	public function __construct() {
		$this->productName = null;
		$this->setUpFee = null;
		$this->monthlyFee = null;
		$this->productDetail = null;
	}
	
	// Desstruct function
	public function __destruct() {
	}
	
	// for product type
	public function getProductName() {
		return ($productName);
	}
	public function setProductName($productName) {
		$this->productName = $productName;
	}
	
	// for set up fee
	public function getSetUpFee() {
		return ($setUpFee);
	}
	
	// for set up fee
	public function setSetUpFee($setUpFee) {
		$this->setUpFee = $setUpFee;
	}
	
	// for product type
	public function getMonthlyFee() {
		return ($monthlyFee);
	}
	public function setMonthlyFee($monthlyFee) {
		$this->monthlyFee = $monthlyFee;
	}
	
	// for product detail
	public function getProductDetail() {
		return ($productDetail);
	}
	public function setProductDetail($productDetail) {
		$this->productDetail = $productDetail;
	}
}

?>
