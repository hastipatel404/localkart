import 'product.dart';

class Order {
  final String id;
  final String userId;
  final List<Product> products;
  final double totalPrice;
  final String status;

  Order({
    required this.id,
    required this.userId,
    required this.products,
    required this.totalPrice,
    required this.status,
  });

  factory Order.fromJson(Map<String, dynamic> json) {
    var productList = (json['products'] as List)
        .map((item) => Product.fromJson(item))
        .toList();

    return Order(
      id: json['id'].toString(),
      userId: json['user_id'].toString(),
      products: productList,
      totalPrice: double.tryParse(json['total_price'].toString()) ?? 0.0,
      status: json['status'],
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'user_id': userId,
      'products': products.map((p) => p.toJson()).toList(),
      'total_price': totalPrice.toString(),
      'status': status,
    };
  }
}
