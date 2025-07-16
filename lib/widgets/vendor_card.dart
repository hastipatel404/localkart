import 'package:flutter/material.dart';
import '../models/vendor.dart';
import '../utils/constants.dart';

class VendorCard extends StatelessWidget {
  final Vendor vendor;
  final VoidCallback? onTap;

  const VendorCard({
    required this.vendor,
    this.onTap,
  });

  @override
  Widget build(BuildContext context) {
    return Card(
      margin: const EdgeInsets.symmetric(vertical: 8),
      elevation: 2,
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
      child: ListTile(
        contentPadding: const EdgeInsets.all(kDefaultPadding),
        title: Text(
          vendor.name,
          style: kTitleStyle,
        ),
        subtitle: Text(vendor.email),
        trailing: Icon(Icons.arrow_forward_ios),
        onTap: onTap,
      ),
    );
  }
}
