class Product {
  final int? id;
  final String? title;
  final String? description;
  final String? image;
  final double? price;

  Product({
    this.id,
    this.title,
    this.description,
    this.image,
    this.price,
  });

  factory Product.fromJson(Map<String, dynamic> json) {
    return Product(
      id: json['id'] as int?,
      title: json['title'] as String?,
      description: json['description'] as String?,
      image: json['image'] as String?,
      price: json['price'] != null ? double.tryParse(json['price'].toString()) : null,
    );
  }
}
