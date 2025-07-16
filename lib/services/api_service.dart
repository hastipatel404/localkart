import '../models/user.dart';
import '../models/vendor.dart';
import '../models/product.dart';

class ApiService {
  static const String baseUrl = 'http://localhost/localkart/backend';

  static Future<User> userLogin(String email, String password) async {
    return User(id: '1', name: 'Test User', email: email);
  }

  static Future<Vendor> vendorLogin(String email, String password) async {
    return Vendor(id: '1', name: 'Test Vendor', email: email);
  }

  static Future<User> userRegister(String name, String email, String password) async {
    return User(id: '2', name: name, email: email);
  }

  static Future<Vendor> vendorRegister(String name, String email, String password) async {
    return Vendor(id: '2', name: name, email: email);
  }

  static Future<List<Product>> getAllProducts() async {
    await Future.delayed(Duration(seconds: 2));
    return [
      Product(
        id: '1',
        vendorId: 'v1',
        name: 'Product 1',
        description: 'Description 1',
        price: 10.0,
        imageUrl: 'http://example.com/image1.png',
      ),
      Product(
        id: '2',
        vendorId: 'v2',
        name: 'Product 2',
        description: 'Description 2',
        price: 15.0,
        imageUrl: 'http://example.com/image2.png',
      ),
    ];
  }

  static Future<List<Product>> getVendorProducts(String vendorId) async {
    await Future.delayed(Duration(seconds: 2));
    return [
      Product(
        id: '101',
        vendorId: vendorId,
        name: 'Vendor Product 1',
        description: 'Vendor Description 1',
        price: 20.0,
        imageUrl: 'http://example.com/vendor1.png',
      ),
    ];
  }

  static Future<bool> addVendorProduct(Product product) async {
    // Simulate API POST call
    await Future.delayed(Duration(seconds: 1));
    print('Adding Product:');
    print('Vendor ID: ${product.vendorId}');
    print('Name: ${product.name}');
    print('Description: ${product.description}');
    print('Price: ${product.price}');
    print('Image URL: ${product.imageUrl}');
    return true;
  }
}
