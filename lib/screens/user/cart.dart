import 'package:flutter/material.dart';
import 'package:get/get.dart';
import '../../controllers/user_controller.dart';
import '../../models/product.dart';
import '../../utils/constants.dart';

class UserCartScreen extends StatelessWidget {
  final UserController userController = Get.find();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: Text('My Cart')),
      body: Obx(() {
        final cartItems = userController.cartItems;
        if (cartItems.isEmpty) {
          return Center(child: Text('Your cart is empty'));
        }

        final total = cartItems.fold<double>(
            0, (sum, item) => sum + item.price);

        return Padding(
          padding: const EdgeInsets.all(kDefaultPadding),
          child: Column(
            children: [
              Expanded(
                child: ListView.builder(
                  itemCount: cartItems.length,
                  itemBuilder: (context, index) {
                    final Product item = cartItems[index];
                    return ListTile(
                      title: Text(item.name),
                      subtitle: Text('₹${item.price.toStringAsFixed(2)}'),
                      trailing: IconButton(
                        icon: Icon(Icons.delete),
                        onPressed: () {
                          userController.removeFromCart(item);
                        },
                      ),
                    );
                  },
                ),
              ),
              Divider(),
              Text(
                'Total: ₹${total.toStringAsFixed(2)}',
                style: kTitleStyle,
              ),
              SizedBox(height: 10),
              ElevatedButton(
                onPressed: () {
                  Get.snackbar('Order Placed', 'Your order has been placed successfully!');
                  userController.clearCart();
                },
                child: Text('Place Order'),
              )
            ],
          ),
        );
      }),
    );
  }
}
