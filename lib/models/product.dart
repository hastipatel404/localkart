class Product {
  final String id;
  final String vendorId;
  final String name;
  final String description;
  final double price;
  final String imageUrl;

  Product({
    required this.id,
    required this.vendorId,
    required this.name,
    required this.description,
    required this.price,
    required this.imageUrl,
  });

  factory Product.fromJson(Map<String, dynamic> json) {
    return Product(
      id: json['id'].toString(),
      vendorId: json['vendor_id'].toString(),
      name: json['name'],
      description: json['description'],
      price: double.tryParse(json['price'].toString()) ?? 0.0,
      imageUrl: json['image_url'],
    );
  }

  Map<String, dynamic> toJson() {
    return {
      'id': id,
      'vendor_id': vendorId,
      'name': name,
      'description': description,
      'price': price.toString(),
      'image_url': imageUrl,
    };
  }
}
