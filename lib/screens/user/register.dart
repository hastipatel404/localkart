import 'package:flutter/material.dart';
import 'package:get/get.dart';
import '../../controllers/user_controller.dart';
import '../../utils/validators.dart';
import '../../utils/constants.dart';

class UserRegisterScreen extends StatelessWidget {
  final _formKey = GlobalKey<FormState>();
  final nameController = TextEditingController();
  final emailController = TextEditingController();
  final passwordController = TextEditingController();
  final UserController userController = Get.find();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: Text('User Register')),
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
              Obx(() => userController.isLoading.value
                  ? CircularProgressIndicator()
                  : ElevatedButton(
                      onPressed: () {
                        if (_formKey.currentState!.validate()) {
                          userController.register(
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
                  Get.toNamed('/user/login');
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
