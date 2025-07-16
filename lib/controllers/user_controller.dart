import 'package:get/get.dart';
import '../models/user.dart';
import '../models/product.dart';
import '../services/api_service.dart';

class UserController extends GetxController {
  // Logged-in user info
  Rxn<User> currentUser = Rxn<User>();

  // Cart
  RxList<Product> cartItems = <Product>[].obs;

  // Loading states
  RxBool isLoading = false.obs;

  // Login
  Future<void> login(String email, String password) async {
    try {
      isLoading.value = true;
      final user = await ApiService.userLogin(email, password);
      currentUser.value = user;
      Get.offAllNamed('/user/home');
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
      final user = await ApiService.userRegister(name, email, password);
      currentUser.value = user;
      Get.offAllNamed('/user/home');
    } catch (e) {
      Get.snackbar('Error', e.toString());
    } finally {
      isLoading.value = false;
    }
  }

  // Cart management
  void addToCart(Product product) {
    cartItems.add(product);
    Get.snackbar('Success', 'Added to cart');
  }

  void removeFromCart(Product product) {
    cartItems.remove(product);
    Get.snackbar('Removed', 'Item removed from cart');
  }

  void clearCart() {
    cartItems.clear();
  }
}
