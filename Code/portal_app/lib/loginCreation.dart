import 'package:flutter/material.dart';

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'My App',
      home: LoginCreationPage(),
    );
  }
}

class LoginCreationPage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        leading: IconButton(
          icon: Icon(Icons.arrow_back, color: Colors.black),
          onPressed: () {
            Navigator.of(context).pop();
          },
        ),
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
