<?php

namespace NeoWeb\Common\Common;

// This file holds the class of Neo order 1 information class set
/**
 * Enter description here ...
 *
 * @author jazwang
 *        
 */
class Order1InfoSet {
	private $orderId;
	private $businessId;
	private $productName;
	private $setUpFee;
	private $monthlyFee;
	private $monthTerm;
	private $storeQuantity;
	private $totalAmount;
	private $taxRate;
	private $amountPaid;
	private $orderStatus;
	private $paymentMethod;
	private $paymentInfo;
	private $orderNote;
	private $orderNumber; // Total number of orders for the company
	                      
	// Construct function
	public function __construct($businessId) {
		$this->orderId = null;
		$this->businessId = $businessId;
		$this->productName = null;
		$this->setUpFee = null;
		$this->monthlyFee = null;
		$this->monthTerm = null;
		$this->storeQuantity = null;
		$this->totalAmount = null;
		$this->taxRate = null;
		$this->amountPaid = null;
		$this->orderStatus = null;
		$this->paymentMethod = null;
		$this->paymentInfo = null;
		$this->orderNote = null;
		$this->orderNumber = null;
	}
	
	// Desstruct function
	public function __destruct() {
	}
	
	// for Order Id
	public function setOrderId($orderId) {
		$this->orderId = $orderId;
	}
	public function getOrderId() {
		return ($this->orderId);
	}
	
	// for business ID
	public function setBusinessId($businessId) {
		$this->businessId = $businessId;
	}
	public function getBusinessId() {
		return ($this->businessId);
	}
	
	// for product name
	public function setProductName($productName) {
		$this->productName = $productName;
	}
	public function getProductName() {
		return ($this->productName);
	}
	
	// for set up fee
	public function setSetUpFee($setUpFee) {
		$this->setUpFee = $setUpFee;
	}
	public function getSetUpFee() {
		return ($this->setUpFee);
	}
	
	// for monthly fee
	public function setMonthlyFee($monthlyFee) {
		$this->monthlyFee = $monthlyFee;
	}
	public function getMonthlyFee() {
		return ($this->monthlyFee);
	}
	
	// for month term
	public function setMonthTerm($monthTerm) {
		$this->monthTerm = $monthTerm;
	}
	public function getMonthTerm() {
		return ($this->monthTerm);
	}
	
	// for store quantity
	public function setStoreQuantity($storeQuantity) {
		$this->storeQuantity = $storeQuantity;
	}
	public function getStoreQuantity() {
		return ($this->storeQuantity);
	}
	
	// for total amount
	public function setTotalAmount($totalAmount) {
		$this->totalAmount = $totalAmount;
	}
	public function getTotalAmount() {
		return ($this->totalAmount);
	}
	
	// for tax rate
	public function setTaxRate($taxRate) {
		$this->taxRate = $taxRate;
	}
	public function getTaxRate() {
		return ($this->taxRate);
	}
	
	// for amount paid
	public function setAmountPaid($amountPaid) {
		$this->amountPaid = $amountPaid;
	}
	public function getAmountPaid() {
		return ($this->amountPaid);
	}
	
	// for order status
	public function setOrderStatus($orderStatus) {
		$this->orderStatus = $orderStatus;
	}
	public function getOrderStatus() {
		return ($this->orderStatus);
	}
	
	// for payment method
	public function setPaymentMethod($paymentMethod) {
		$this->paymentMethod = $paymentMethod;
	}
	public function getPaymentMethod() {
		return ($this->paymentMethod);
	}
	
	// for payment Info
	public function setPaymentInfo($paymentInfo) {
		$this->paymentInfo = $paymentInfo;
	}
	public function getPaymentInfo() {
		return ($this->paymentInfo);
	}
	
	// for Order Note
	public function setOrderNote($orderNote) {
		$this->orderNote = $orderNote;
	}
	public function getOrderNote() {
		return ($this->orderNote);
	}
	
	// for Order number
	public function setOrderNumber($orderNumber) {
		$this->orderNumber = $orderNumber;
	}
	public function getOrderNumber() {
		return ($this->orderNumber);
	}
}

?>
