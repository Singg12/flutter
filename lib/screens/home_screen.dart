import 'package:flutter/material.dart';
import '../models/product.dart';
import '../services/api_service.dart';

class HomeScreen extends StatelessWidget {
  const HomeScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Shop')),
      body: FutureBuilder<List<Product>>(
        future: ApiService.fetchProducts(),
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return const Center(child: CircularProgressIndicator());
          } else if (snapshot.hasError) {
            return Center(child: Text('Error: ${snapshot.error}'));
          } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
            return const Center(child: Text('No products found.'));
          }

          final products = snapshot.data!;
          return GridView.builder(
            padding: const EdgeInsets.all(10),
            itemCount: products.length,
            gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
              crossAxisCount: 2,
              mainAxisSpacing: 10,
              crossAxisSpacing: 10,
              childAspectRatio: 0.7,
            ),
            itemBuilder: (ctx, i) => Card(
              elevation: 3,
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.center,
                children: [
                  products[i].image != null
                      ? Image.network(
                          products[i].image!,
                          height: 100,
                          errorBuilder: (context, error, stackTrace) => const Icon(Icons.error, size: 100),
                        )
                      : const Icon(Icons.image_not_supported, size: 100),
                  Padding(
                    padding: const EdgeInsets.all(8.0),
                    child: Text(
                      products[i].title ?? 'No title',
                      maxLines: 2,
                      overflow: TextOverflow.ellipsis,
                      textAlign: TextAlign.center,
                    ),
                  ),
                  Text(
                    products[i].price != null
                        ? '\$${products[i].price!.toStringAsFixed(2)}'
                        : 'Price N/A',
                  ),
                ],
              ),
            ),
          );
        },
      ),
    );
  }
}
