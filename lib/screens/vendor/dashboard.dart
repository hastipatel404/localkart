import 'package:flutter/material.dart';
import 'package:get/get.dart';
import '../../controllers/vendor_controller.dart';
import '../../widgets/product_card.dart';
import '../../utils/constants.dart';

class VendorDashboardScreen extends StatelessWidget {
  final VendorController vendorController = Get.find();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Vendor Dashboard'),
        actions: [
          IconButton(
            icon: Icon(Icons.add),
            onPressed: () {
              Get.toNamed('/vendor/add_product');
            },
          ),
        ],
      ),
      body: Obx(() {
        if (vendorController.isLoading.value) {
          return Center(child: CircularProgressIndicator());
        }

        if (vendorController.vendorProducts.isEmpty) {
          return Center(child: Text('No products found'));
        }

        return ListView.builder(
          padding: const EdgeInsets.all(kDefaultPadding),
          itemCount: vendorController.vendorProducts.length,
          itemBuilder: (context, index) {
            final product = vendorController.vendorProducts[index];
            return ProductCard(product: product);
          },
        );
      }),
    );
  }
}
