import 'package:flutter/material.dart';
import 'package:get/get.dart';
import '../../controllers/vendor_controller.dart';
import '../../models/product.dart';
import '../../utils/constants.dart';
import '../../utils/validators.dart';

class VendorAddProductScreen extends StatelessWidget {
  final _formKey = GlobalKey<FormState>();
  final nameController = TextEditingController();
  final descriptionController = TextEditingController();
  final priceController = TextEditingController();
  final imageUrlController = TextEditingController();
  final VendorController vendorController = Get.find();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: Text('Add Product')),
      body: Padding(
        padding: const EdgeInsets.all(kDefaultPadding),
        child: Form(
          key: _formKey,
          child: SingleChildScrollView(
            child: Column(
              children: [
                TextFormField(
                  controller: nameController,
                  decoration: InputDecoration(labelText: 'Product Name'),
                  validator: Validators.validateName,
                ),
                TextFormField(
                  controller: descriptionController,
                  decoration: InputDecoration(labelText: 'Description'),
                  validator: (v) => Validators.validateNotEmpty(v, 'Description'),
                ),
                TextFormField(
                  controller: priceController,
                  decoration: InputDecoration(labelText: 'Price'),
                  keyboardType: TextInputType.number,
                  validator: (v) => Validators.validateNotEmpty(v, 'Price'),
                ),
                TextFormField(
                  controller: imageUrlController,
                  decoration: InputDecoration(labelText: 'Image URL'),
                  validator: (v) => Validators.validateNotEmpty(v, 'Image URL'),
                ),
                SizedBox(height: 20),
                Obx(() => vendorController.isLoading.value
                    ? CircularProgressIndicator()
                    : ElevatedButton(
                        onPressed: () {
                          if (_formKey.currentState!.validate()) {
                            final product = Product(
                              id: '',
                              vendorId: vendorController.currentVendor.value!.id,
                              name: nameController.text,
                              description: descriptionController.text,
                              price: double.tryParse(priceController.text) ?? 0.0,
                              imageUrl: imageUrlController.text,
                            );
                            vendorController.addProduct(product);
                            Get.back();
                          }
                        },
                        child: Text('Add Product'),
                      )),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
