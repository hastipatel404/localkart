import 'package:flutter/material.dart';
import '../models/product.dart';
import '../utils/constants.dart';

class ProductCard extends StatelessWidget {
  final Product product;
  final VoidCallback? onAddToCart;

  const ProductCard({
    required this.product,
    this.onAddToCart,
  });

  @override
  Widget build(BuildContext context) {
    return Card(
      margin: const EdgeInsets.symmetric(vertical: 8),
      elevation: 3,
      shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
      child: Padding(
        padding: const EdgeInsets.all(kDefaultPadding),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            if (product.imageUrl.isNotEmpty)
              ClipRRect(
                borderRadius: BorderRadius.circular(8),
                child: Image.network(
                  product.imageUrl,
                  height: 180,
                  width: double.infinity,
                  fit: BoxFit.cover,
                ),
              ),
            SizedBox(height: 10),
            Text(
              product.name,
              style: kTitleStyle,
            ),
            SizedBox(height: 5),
            Text(
              product.description,
              style: kSubtitleStyle,
            ),
            SizedBox(height: 10),
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Text(
                  '₹${product.price.toStringAsFixed(2)}',
                  style: kTitleStyle.copyWith(color: kPrimaryColor),
                ),
                if (onAddToCart != null)
                  ElevatedButton(
                    onPressed: onAddToCart,
                    child: Text('Add to Cart'),
                  ),
              ],
            )
          ],
        ),
      ),
    );
  }
}
