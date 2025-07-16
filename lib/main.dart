import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'routes/app_routes.dart';
import 'utils/constants.dart';

void main() {
  runApp(LocalkartApp());
}

class LocalkartApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return GetMaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'Localkart',
      theme: ThemeData(
        primaryColor: kPrimaryColor,
        colorScheme: ColorScheme.fromSeed(seedColor: kPrimaryColor),
        useMaterial3: true,
        fontFamily: 'Roboto',
      ),
      initialRoute: AppRoutes.userLogin,
      getPages: AppRoutes.routes,
    );
  }
}
