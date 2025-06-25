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

        // PIC FUNCTION
        public function formAddPic() {
            return BASE_PATH . "/pages/pic/picForm.php"; }
        public function formUpdatePic() {
            return BASE_PATH . "/pages/pic/picForm.php?id="; }
        public function addPic() {
            return BASE_PATH . "/function/pic.php?action=add"; }
        public function updatePic() {
            return BASE_PATH . "/function/pic.php?action=update"; }
        public function deletePic() {
            return BASE_PATH . "/function/pic.php?action=delete"; }

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

        // PAYMENT FUNCTION
        public function formAddPayment() {
            return BASE_PATH . "/pages/payment/paymentForm.php"; }
        public function formUpdatePayment() {
            return BASE_PATH . "/pages/payment/paymentForm.php"; }
        public function addPayment() {
            return BASE_PATH . "/function/payment.php?action=add&inv="; }
        public function updatePayment() {
            return BASE_PATH . "/function/payment.php?action=update&id="; }
        public function deletePayment() {
            return BASE_PATH . "/function/payment.php?action=delete"; }

        // SETTING FUNCTION
        public function formSettingDetail() {
            return BASE_PATH . "/pages/setting/settingForm.php?action=detail"; }
        public function formSettingLogo() {
            return BASE_PATH . "/pages/setting/settingForm.php?action=logo"; }
        public function updateSetting($update) {
            return BASE_PATH . "/function/setting.php?action=$update";
        }
    }
?>