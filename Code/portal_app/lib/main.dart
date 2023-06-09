import 'package:flutter/material.dart';

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'My App',
      home: LoginPage(),
    );
  }
}

class LoginPage extends StatelessWidget {
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
      body: Container(
        decoration: BoxDecoration(
          image: DecorationImage(
            image: AssetImage('ressources/images/logoSite.png'),
            fit: BoxFit.fitWidth,
            colorFilter: ColorFilter.mode(
              Colors.white.withOpacity(0.2),
              BlendMode.dstATop,
            ),
          ),
        ),
        child: Center(
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Text(
                'Nouveau voyageur gourmand',
                style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold),
              ),
              SizedBox(height: 20),
              Container(
                width: 200, // Adjust the width as needed
                child: TextButton(
                  onPressed: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(builder: (context) => LoginCreationPage()),
                    );
                  },
                  child: Text(
                    'Créer un compte',
                    style: TextStyle(fontSize: 18),
                  ),
                ),
              ),
              SizedBox(height: 20),
              Text(
                'Formulaire de connexion',
                style: TextStyle(fontSize: 18, fontStyle: FontStyle.italic),
              ),
              SizedBox(height: 20),
              Padding(
                padding: EdgeInsets.symmetric(horizontal: 20),
                child: Column(
                  children: [
                    SizedBox(height: 10),
                    Padding(
                      padding: EdgeInsets.only(left: 20, right: 20),
                      child: TextField(
                        textAlign: TextAlign.center,
                        decoration: InputDecoration(
                          labelText: 'Email',
                        ),
                      ),
                    ),
                    SizedBox(height: 10),
                    Padding(
                      padding: EdgeInsets.only(left: 20, right: 20),
                      child: TextField(
                        textAlign: TextAlign.center,
                        obscureText: true,
                        decoration: InputDecoration(
                          labelText: 'Mot de passe',
                        ),
                      ),
                    ),
                  ],
                ),
              ),
              SizedBox(height: 20),
              ElevatedButton(
                onPressed: () {
                  // Action à effectuer lors de la connexion
                },
                child: Text('Connexion'),
              ),
            ],
          ),
        ),
      ),
      drawer: Drawer(
        child: ListView(
          children: [
            DrawerHeader(
              decoration: BoxDecoration(
                color: Color.fromRGBO(242, 242, 242, 1.0),
              ),
              child: Row(
                children: [
                  Flexible(
                    child: Image.asset(
                      'ressources/images/logoSite.png',
                      fit: BoxFit.contain,
                    ),
                  ),
                ],
              ),
            ),
            ListTile(
              title: Text(
                'Connexion',
                style: TextStyle(
                  color: Colors.black, // Couleur du texte des éléments du drawer
                ),
              ),
              onTap: () {
                // Action à effectuer lors du clic sur Connexion
              },
            ),
            ListTile(
              title: Text(
                'Affichage des données utilisateurs',
                style: TextStyle(
                  color: Colors.black, // Couleur du texte des éléments du drawer
                ),
              ),
              onTap: () {
                // Action à effectuer lors du clic sur Affichage des données utilisateurs
              },
            ),
            ListTile(
              title: Text(
                'Déconnexion',
                style: TextStyle(
                  color: Colors.black, // Couleur du texte des éléments du drawer
                ),
              ),
              onTap: () {
                // Action à effectuer lors du clic sur Déconnexion
              },
            ),
          ],
        ),
      ),
      bottomNavigationBar: Container(
        height: 50,
        color: Color.fromRGBO(242, 242, 242, 1.0),
        child: Center(
          child: Text(
            '© Droits d\'auteur',
            style: TextStyle(fontSize: 16, fontWeight: FontWeight.bold),
          ),
        ),
      ),
    );
  }
}

class LoginCreationPage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Créer un compte'),
      ),
      body: Center(
        child: Text(
          'Contenu de la page de création de compte',
          style: TextStyle(fontSize: 24),
        ),
      ),
    );
  }
}
