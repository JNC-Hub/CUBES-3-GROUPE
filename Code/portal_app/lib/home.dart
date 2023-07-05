import 'package:flutter/material.dart';
import 'package:portal_app/loginCreation.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';
import 'affichageUtilisateur.dart';
import 'utilisateur.dart';

class HomePage extends StatefulWidget {
  @override
  _HomePageState createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  TextEditingController emailController = TextEditingController();
  TextEditingController passwordController = TextEditingController();

  //Pour afficher/masquer password
  bool isPasswordVisible = false;

  //Pour récupérer les données utilisateur de l'API
  Map<String, dynamic>? data;

  Future<bool> connectUser() async {
    // var url = 'http://localhost/Code/apiFlutter/getUtilisateurLogin.php';
    var url = 'https://lesvoyageursgourmands.online/apiFlutter/getUtilisateurLogin.php';
    try {
      var response = await http.post(
        Uri.parse(url),
        headers: {'Content-Type': 'application/json'},
        body: jsonEncode({
          'mail': emailController.text,
          'password': passwordController.text,
        }),
      );

      if (response.statusCode == 200) {
          data = jsonDecode(response.body);
          print(response.body);
          return true;
      } else {
        print('Échec de la connexion');
        return false;
      }
    } catch (e) {
      print('Erreur de la connexion : $e');
      return false;
    }
  }

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
                        controller: emailController,
                        textAlign: TextAlign.center,
                        decoration: InputDecoration(
                          labelText: 'Email',
                        ),
                      ),
                    ),
                    SizedBox(height: 10),
                    Padding(
                      padding: EdgeInsets.only(left: 20, right: 20),
                      child: TextFormField(
                        controller: passwordController,
                        textAlign: TextAlign.center,
                        obscureText: !isPasswordVisible,
                        decoration: InputDecoration(
                          labelText: 'Mot de passe',
                          suffixIcon: GestureDetector(
                            onTap: () {
                              setState(() {
                                isPasswordVisible = !isPasswordVisible;
                                });
                            },
                            child: Icon(
                              isPasswordVisible ? Icons.visibility : Icons.visibility_off,
                            ),
                          ),
                        ),
                      ),
                    ),
                  ],
                ),
              ),
              SizedBox(height: 20),
              ElevatedButton(
                onPressed: () async {
                  bool loginSuccess = await connectUser();
                  print(loginSuccess);
                  if (loginSuccess) {
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (context) => AffichageUtilisateurPage(
                          utilisateur: Utilisateur(
                            idUtilisateur: data?['idUtilisateur'],
                            nom: data?['nom'],
                            prenom: data?['prenom'],
                            mail: data?['mail'],
                          ),
                        ),
                      ),
                    );
                  } else {
                    ScaffoldMessenger.of(context).showSnackBar(
                      SnackBar(
                        content: Text('Identifiants invalides'),
                        duration: Duration(seconds: 2),
                        backgroundColor: Colors.grey,
                      ),
                    );
                  }
                },
                child: Text('Connexion'),
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