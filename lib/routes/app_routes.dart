import 'package:get/get.dart';
import '../bindings/user_binding.dart';
import '../bindings/vendor_binding.dart';
import '../screens/user/login.dart';
import '../screens/user/register.dart';
import '../screens/user/home.dart';
import '../screens/user/cart.dart';
import '../screens/vendor/login.dart';
import '../screens/vendor/register.dart';
import '../screens/vendor/dashboard.dart';
import '../screens/vendor/add_product.dart';

class AppRoutes {
  static const String userLogin = '/user/login';
  static const String userRegister = '/user/register';
  static const String userHome = '/user/home';
  static const String userCart = '/user/cart';

  static const String vendorLogin = '/vendor/login';
  static const String vendorRegister = '/vendor/register';
  static const String vendorDashboard = '/vendor/dashboard';
  static const String vendorAddProduct = '/vendor/add_product';

  static final routes = [
    GetPage(
      name: userLogin,
      page: () => UserLoginScreen(),
      binding: UserBinding(),
    ),
    GetPage(
      name: userRegister,
      page: () => UserRegisterScreen(),
      binding: UserBinding(),
    ),
    GetPage(
      name: userHome,
      page: () => UserHomeScreen(),
      binding: UserBinding(),
    ),
    GetPage(
      name: userCart,
      page: () => UserCartScreen(),
      binding: UserBinding(),
    ),

    GetPage(
      name: vendorLogin,
      page: () => VendorLoginScreen(),
      binding: VendorBinding(),
    ),
    GetPage(
      name: vendorRegister,
      page: () => VendorRegisterScreen(),
      binding: VendorBinding(),
    ),
    GetPage(
      name: vendorDashboard,
      page: () => VendorDashboardScreen(),
      binding: VendorBinding(),
    ),
    GetPage(
      name: vendorAddProduct,
      page: () => VendorAddProductScreen(),
      binding: VendorBinding(),
    ),
  ];
}
