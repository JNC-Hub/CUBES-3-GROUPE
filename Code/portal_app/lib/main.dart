import 'package:flutter/material.dart';
import 'package:portal_app/home.dart';
import 'package:portal_app/loginCreation.dart';
import 'package:portal_app/affichageUtilisateur.dart';

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'My App',
      //initialRoute: '/',
     // routes: {
        //'/': (context) => LoginCreationPage(),
        home: HomePage(),
    );
  }
}
