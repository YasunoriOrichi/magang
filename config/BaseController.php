<?php
session_start();
require_once 'env.php';
    class BaseController {
        // CUSTOMER FUNCTION
        public function formAddCustomer() {
            return BASE_PATH . "/pages/customer/customerForm.php"; }
        public function formUpdateCustomer() {
            return BASE_PATH . "/pages/customer/customerForm.php?id="; }
        public function addCustomer() {
            return BASE_PATH . "/function/customer.php?action=add"; }
        public function updateCustomer() {
            return BASE_PATH . "/function/customer.php?action=update"; }
        public function deleteCustomer() {
            return BASE_PATH . "/function/customer.php?action=delete"; }

        // ITEM FUNCTION
        public function formAddItem() {
            return BASE_PATH . "/pages/item/itemForm.php"; }
        public function formUpdateItem() {
            return BASE_PATH . "/pages/item/itemForm.php?id="; }
        public function addItem() {
            return BASE_PATH . "/function/item.php?action=add"; }
        public function updateItem() {
            return BASE_PATH . "/function/item.php?action=update"; }
        public function deleteItem() {
            return BASE_PATH . "/function/item.php?action=delete"; }
        // SUPPLIER FUNCTION
        public function formAddSupplier() {
            return BASE_PATH . "/pages/supplier/supplierForm.php"; }
        public function formUpdateSupplier() {
            return BASE_PATH . "/pages/supplier/supplierForm.php?id="; }
        public function addSupplier() {
            return BASE_PATH . "/function/supplier.php?action=add"; }
        public function updateSupplier() {
            return BASE_PATH . "/function/supplier.php?action=update"; }
        public function deleteSupplier() {
            return BASE_PATH . "/function/supplier.php?action=delete"; }

        // ITEM CUSTOMER FUNCTION
        public function formAddItemCustomer() {
            return BASE_PATH . "/pages/itemCustomer/itemCustomerForm.php"; }
        public function formUpdateItemCustomer() {
            return BASE_PATH . "/pages/itemCustomer/itemCustomerForm.php?id="; }
        public function addItemCustomer() {
            return BASE_PATH . "/function/itemCustomer.php?action=add"; }
        public function updateItemCustomer() {
            return BASE_PATH . "/function/itemCustomer.php?action=update"; }
        public function deleteItemCustomer() {
            return BASE_PATH . "/function/itemCustomer.php?action=delete"; }

        // INVOICE
        public function detailInvoice() {
            return BASE_PATH . "/pages/invoice/detailInvoice.php?inv="; }
        public function formAddInvoice() {
            return BASE_PATH . "/pages/invoice/invoiceForm.php"; }
        public function formAddDetailInvoice() {
            return BASE_PATH . "/pages/invoice/detailInvoiceForm.php?inv="; }
         public function formUpdateInvoice() {
            return BASE_PATH . "/pages/invoice/invoiceForm.php?inv="; }
         public function formUpdateDetailInvoice() {
            return BASE_PATH . "/pages/invoice/detailInvoiceForm.php?id="; }
        public function addInvoice() {
            return BASE_PATH . "/function/invoice.php?action=add"; }
        public function addDetailInvoice() {
            return BASE_PATH . "/function/invoice.php?action=addDetail"; }
        public function updateInvoice() {
            return BASE_PATH . "/function/invoice.php?action=update"; }
        public function updateDetailInvoice() {
            return BASE_PATH . "/function/invoice.php?action=updateDetail"; }
        public function deleteInvoice() {
            return BASE_PATH . "/function/invoice.php?action=delete&inv="; }
        public function deleteDetailInvoice() {
            return BASE_PATH . "/function/invoice.php?action=deleteDetail"; }

        // OMSET FUNCTION
        public function omsetByDay($whereClause) {
            return BASE_PATH . "/function/omset.php?type=day"; }
        public function omsetByWeek($whereClause) {
            return BASE_PATH . "/function/omset.php?type=week"; }
        public function omsetByMonth($whereClause) {
            return BASE_PATH . "/function/omset.php?type=month"; }

        // COMPONENT FUNCTION
        public function navbar() {
            return BASE_PATH . "/component/navbar.php"; }
        public function sidebar() {
            return BASE_PATH . "/component/sidebar.php"; }
        public function notification() {
            return BASE_PATH . "/component/notification.php"; }
    }
?>