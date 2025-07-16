import 'package:flutter/material.dart';
import 'package:get/get.dart';
import '../../controllers/vendor_controller.dart';
import '../../utils/validators.dart';
import '../../utils/constants.dart';

class VendorRegisterScreen extends StatelessWidget {
  final _formKey = GlobalKey<FormState>();
  final nameController = TextEditingController();
  final emailController = TextEditingController();
  final passwordController = TextEditingController();
  final VendorController vendorController = Get.find();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: Text('Vendor Register')),
      body: Padding(
        padding: const EdgeInsets.all(kDefaultPadding),
        child: Form(
          key: _formKey,
          child: Column(
            children: [
              TextFormField(
                controller: nameController,
                decoration: InputDecoration(labelText: 'Name'),
                validator: Validators.validateName,
              ),
              TextFormField(
                controller: emailController,
                decoration: InputDecoration(labelText: 'Email'),
                validator: Validators.validateEmail,
              ),
              TextFormField(
                controller: passwordController,
                decoration: InputDecoration(labelText: 'Password'),
                obscureText: true,
                validator: Validators.validatePassword,
              ),
              SizedBox(height: 20),
              Obx(() => vendorController.isLoading.value
                  ? CircularProgressIndicator()
                  : ElevatedButton(
                      onPressed: () {
                        if (_formKey.currentState!.validate()) {
                          vendorController.register(
                            nameController.text,
                            emailController.text,
                            passwordController.text,
                          );
                        }
                      },
                      child: Text('Register'),
                    )),
              TextButton(
                onPressed: () {
                  Get.toNamed('/vendor/login');
                },
                child: Text('Already have an account? Login'),
              )
            ],
          ),
        ),
      ),
    );
  }
}
