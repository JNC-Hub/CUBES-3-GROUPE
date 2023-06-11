import 'package:flutter/material.dart';

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'My App',
      initialRoute: '/',
      routes: {
        '/': (context) => AffichageUtilisateurPage(),
        '/profile': (context) => ProfilePage(
          name: 'John',
          firstName: 'Doe',
          email: 'john.doe@example.com',
        ),
      },
    );
  }
}

class AffichageUtilisateurPage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          'Les Voyageurs Gourmands',
          style: TextStyle(
            color: Colors.black, // Couleur du texte de la appBar
          ),
        ),
        backgroundColor: Color.fromRGBO(242, 242, 242, 1.0),
        iconTheme: IconThemeData(
          color: Colors.black, // Couleur des icônes du bouton du Drawer
        ),
      ),
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Text(
              'Page de connexion',
              style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold),
            ),
            ElevatedButton(
              onPressed: () {
                Navigator.pushNamed(context, '/profile');
              },
              child: Text('Se connecter'),
            ),
          ],
        ),
      ),
    );
  }
}

class ProfilePage extends StatelessWidget {
  final String name;
  final String firstName;
  final String email;

  ProfilePage({required this.name, required this.firstName, required this.email});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          'Mon Profil',
          style: TextStyle(
            color: Colors.black, // Couleur du texte de la appBar
          ),
        ),
        backgroundColor: Color.fromRGBO(242, 242, 242, 1.0),
        iconTheme: IconThemeData(
          color: Colors.black, // Couleur des icônes du bouton du Drawer
        ),
      ),
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Text(
              'Nom: $name',
              style: TextStyle(fontSize: 18),
            ),
            Text(
              'Prénom: $firstName',
              style: TextStyle(fontSize: 18),
            ),
            Text(
              'Email: $email',
              style: TextStyle(fontSize: 18),
            ),
          ],
        ),
      ),
    );
  }
}
