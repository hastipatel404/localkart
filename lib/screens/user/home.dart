import 'package:flutter/material.dart';
import 'package:get/get.dart';
import '../../controllers/user_controller.dart';
import '../../models/product.dart';
import '../../widgets/product_card.dart';
import '../../services/api_service.dart';
import '../../utils/constants.dart';

class UserHomeScreen extends StatefulWidget {
  @override
  State<UserHomeScreen> createState() => _UserHomeScreenState();
}

class _UserHomeScreenState extends State<UserHomeScreen> {
  final ApiService apiService = ApiService();  // ✅ Create instance
  List<Product> products = [];
  bool isLoading = true;

  @override
  void initState() {
    super.initState();
    loadProducts();
  }

  Future<void> loadProducts() async {
    try {
      products = await ApiService.getAllProducts();  // ✅ Call instance method
    } catch (e) {
      print('Error loading products: $e');
      products = [];
    } finally {
      setState(() {
        isLoading = false;
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    final UserController userController = Get.find();

    return Scaffold(
      appBar: AppBar(
        title: Text('Localkart Home'),
        actions: [
          IconButton(
            icon: Icon(Icons.shopping_cart),
            onPressed: () => Get.toNamed('/user/cart'),
          ),
        ],
      ),
      body: isLoading
          ? Center(child: CircularProgressIndicator())
          : products.isEmpty
              ? Center(child: Text('No products available'))
              : ListView.builder(
                  padding: const EdgeInsets.all(kDefaultPadding),
                  itemCount: products.length,
                  itemBuilder: (context, index) {
                    final product = products[index];
                    return ProductCard(
                      product: product,
                      onAddToCart: () {
                        userController.addToCart(product);
                      },
                    );
                  },
                ),
    );
  }
}
