import 'package:get/get.dart';
import '../models/vendor.dart';
import '../models/product.dart';
import '../services/api_service.dart';

class VendorController extends GetxController {
  // Logged-in vendor info
  Rxn<Vendor> currentVendor = Rxn<Vendor>();

  // Vendor's product list
  RxList<Product> vendorProducts = <Product>[].obs;

  // Loading state
  RxBool isLoading = false.obs;

  // Login
  Future<void> login(String email, String password) async {
    try {
      isLoading.value = true;
      final vendor = await ApiService.vendorLogin(email, password);
      currentVendor.value = vendor;
      await fetchVendorProducts();
      Get.offAllNamed('/vendor/dashboard');
    } catch (e) {
      Get.snackbar('Error', e.toString());
    } finally {
      isLoading.value = false;
    }
  }

  // Register
  Future<void> register(String name, String email, String password) async {
    try {
      isLoading.value = true;
      final vendor = await ApiService.vendorRegister(name, email, password);
      currentVendor.value = vendor;
      Get.offAllNamed('/vendor/dashboard');
    } catch (e) {
      Get.snackbar('Error', e.toString());
    } finally {
      isLoading.value = false;
    }
  }

  // Fetch vendor's products
  Future<void> fetchVendorProducts() async {
    try {
      isLoading.value = true;
      final vendorId = currentVendor.value?.id;
      if (vendorId != null) {
        final products = await ApiService.getVendorProducts(vendorId);
        vendorProducts.assignAll(products);
      } else {
        Get.snackbar('Error', 'Vendor not logged in');
      }
    } catch (e) {
      Get.snackbar('Error', 'Failed to load products');
    } finally {
      isLoading.value = false;
    }
  }

  // Add new product
  Future<void> addProduct(Product product) async {
    try {
      isLoading.value = true;
      final success = await ApiService.addVendorProduct(product);
      if (success) {
        await fetchVendorProducts();
        Get.snackbar('Success', 'Product added successfully');
      } else {
        Get.snackbar('Error', 'Failed to add product');
      }
    } catch (e) {
      Get.snackbar('Error', e.toString());
    } finally {
      isLoading.value = false;
    }
  }
}
