import 'package:flutter/material.dart';

class HomePage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          'Les Voyageurs Gourmands',
          style: TextStyle(
            color: Colors.black,
          ),
        ),
        backgroundColor: Color.fromRGBO(242, 242, 242, 1.0),
        iconTheme: IconThemeData(
          color: Colors.black,
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
                width: 200,
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
                  color: Colors.black,
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
                  color: Colors.black,
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
                  color: Colors.black,
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
        title: Text(
          'Les Voyageurs Gourmands',
          style: TextStyle(
            color: Colors.black,
          ),
        ),
        backgroundColor: Color.fromRGBO(242, 242, 242, 1.0),
        iconTheme: IconThemeData(
          color: Colors.black,
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
            mainAxisAlignment: MainAxisAlignment.start,
            children: [
              SizedBox(height: 40),
              Container(
                width: 200,
              ),
              SizedBox(height: 20),
              Text(
                'Création de compte',
                style: TextStyle(fontSize: 18, fontStyle: FontStyle.italic),
              ),
              SizedBox(height: 20),
              Expanded(
                child: SingleChildScrollView(
                  child: Padding(
                    padding: EdgeInsets.symmetric(horizontal: 20),
                    child: Column(
                      children: [
                        SizedBox(height: 10),
                        Padding(
                          padding: EdgeInsets.only(left: 20, right: 20),
                          child: TextField(
                            textAlign: TextAlign.center,
                            decoration: InputDecoration(
                              labelText: 'Nom *',
                            ),
                          ),
                        ),
                        SizedBox(height: 10),
                        Padding(
                          padding: EdgeInsets.only(left: 20, right: 20),
                          child: TextField(
                            textAlign: TextAlign.center,
                            decoration: InputDecoration(
                              labelText: 'Prénom *',
                            ),
                          ),
                        ),
                        SizedBox(height: 10),
                        Padding(
                          padding: EdgeInsets.only(left: 20, right: 20),
                          child: TextField(
                            textAlign: TextAlign.center,
                            decoration: InputDecoration(
                              labelText: 'Email *',
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
                              labelText: 'Mot de passe *',
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
                              labelText: 'Confirmation du mot de passe *',
                            ),
                          ),
                        ),
                        SizedBox(height: 20),
                        ElevatedButton(
                          onPressed: () {
                            // Action à effectuer lors de la création de compte
                          },
                          child: Text('Création de compte'),
                        ),
                      ],
                    ),
                  ),
                ),
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
                  color: Colors.black,
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
                  color: Colors.black,
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
                  color: Colors.black,
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
