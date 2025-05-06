

import 'dart:convert';
import 'package:http/http.dart' as http;
import '../models/product.dart';

class ApiService {
  static Future<List<Product>> fetchProducts() async {
    final response = await http.get(Uri.parse('http://127.0.0.1:8000/api/products'));

    if (response.statusCode == 200) {
      List<dynamic> data = jsonDecode(response.body);
      return data.map((json) => Product.fromJson(json as Map<String, dynamic>)).toList();
    } else {
      throw Exception('Failed to load products: ${response.statusCode} - ${response.body}');
    }
  }
}


//  @override
//   Widget build(BuildContext context) {
//     return FutureBuilder<List<Products>>(
//       future: fetchProducts(),
//       builder: (context, snapshot) {
//         if (snapshot.connectionState == ConnectionState.waiting) {
//           return Center(child: CircularProgressIndicator());
//         } else if (snapshot.hasError) {
//           return Center(child: Text('Error: ${snapshot.error}'));
//         } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
//           return Center(child: Text('No products found.'));
//         } else {
//           final products = snapshot.data!;

//           return GridView.builder(
//             physics: NeverScrollableScrollPhysics(),
//             shrinkWrap: true,
//             gridDelegate: SliverGridDelegateWithFixedCrossAxisCount(
//               crossAxisCount: 2,
//               childAspectRatio: 0.68,
//             ),
//             itemCount: products.length,
//             itemBuilder: (context, index) {
//               final product = products[index];

//               return Container(
//                 padding: EdgeInsets.only(left: 15, right: 15, top: 10),
//                 margin: EdgeInsets.symmetric(vertical: 8, horizontal: 10),
//                 decoration: BoxDecoration(
//                   color: Colors.white,
//                   borderRadius: BorderRadius.circular(20),
//                 ),
//                 child: Column(
//                   children: [
//                     Row(
//                       // onTap: () {
//                       //   Navigator.pushNamed(context, "/itemPage");
//                       // }, 

//                       mainAxisAlignment: MainAxisAlignment.spaceBetween,
//                       children: [
//                         Container(
//                           padding: EdgeInsets.all(5),
//                           decoration: BoxDecoration(
//                             color: Color(0xff4C53A5),
//                             borderRadius: BorderRadius.circular(20),
//                           ),
//                           child: Text(
//                             "-50%",
//                             style: TextStyle(
//                               fontSize: 14,
//                               color: Colors.white,
//                               fontWeight: FontWeight.bold,
//                             ),
//                           ),
//                         ),
//                         Icon(Icons.favorite_border, color: Colors.red),
//                       ],
//                     ),
//                     InkWell(
//                       onTap: () {},
//                       child: Container(
//                         margin: EdgeInsets.all(10),
//                         child: Image.network(
//                           product.image, // here!
//                           width: 120,
//                           height: 120,
//                           fit: BoxFit.cover,
//                           errorBuilder: (context, error, stackTrace) {
//                             return Icon(Icons.broken_image, size: 80);
//                           },
//                         ),
//                       ),
//                     ),
//                     Container(
//                       padding: EdgeInsets.only(bottom: 8),
//                       alignment: Alignment.centerLeft,
//                       child: Text(
//                         product.title,
//                         style: TextStyle(
//                           fontSize: 18,
//                           color: Color(0xff4C53A5),
//                           fontWeight: FontWeight.bold,
//                         ),
//                         overflow: TextOverflow.ellipsis,
//                       ),
//                     ),
//                     Container(
//                       alignment: Alignment.centerLeft,
//                       child: Text(
//                         product.description,
//                         style: TextStyle(
//                           fontSize: 15,
//                           color: Color(0xff4C53A5),
//                         ),
//                         maxLines: 2,
//                         overflow: TextOverflow.ellipsis,
//                       ),
//                     ),
//                     Padding(
//                       padding: EdgeInsets.symmetric(vertical: 10),
//                       child: Row(
//                         mainAxisAlignment: MainAxisAlignment.spaceBetween,
//                         children: [
//                           Text(
//                             "\$${product.price.toStringAsFixed(2)}",
//                             style: TextStyle(
//                               fontSize: 16,
//                               fontWeight: FontWeight.bold,
//                               color: Color(0xff4C53A5),
//                             ),
//                           ),
//                           Icon(
//                             Icons.shopping_cart_checkout,
//                             color: Color(0xff4C53A5),
//                           ),
//                         ],
//                       ),
//                     ),
//                   ],
//                 ),
//               );
//             },
//           );
//         }
//       },
//     );
//   }
// }
