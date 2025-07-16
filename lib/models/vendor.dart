class Vendor {
  final String id;
  final String name;
  final String email;

  Vendor({required this.id, required this.name, required this.email});

  factory Vendor.fromJson(Map<String, dynamic> json) {
    return Vendor(
      id: json['id'],
      name: json['name'],
      email: json['email'],
    );
  }
}
