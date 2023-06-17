import 'package:flutter/material.dart';
import 'utilisateur.dart';

class AffichageUtilisateurPage extends StatelessWidget {
  final Utilisateur utilisateur;

  AffichageUtilisateurPage({required this.utilisateur});

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
          child: SingleChildScrollView(
            child: Column(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                SizedBox(height: 40),
                Container(
                  width: 200,
                ),
                SizedBox(height: 20),
                Center(
                  child: Text(
                    'Bienvenue ${utilisateur.prenom} ${utilisateur.nom} !',
                    style: TextStyle(fontSize: 24),
                  ),
                ),
                SizedBox(height: 20),
                Text(
                  'Votre email est : ${utilisateur.mail}',
                  style: TextStyle(fontSize: 18),
                ),
                SizedBox(height: 20),
                ElevatedButton(
                  onPressed: () {
                    // Return to the home page and remove all navigation history
                    Navigator.of(context).pushNamedAndRemoveUntil('/', (route) => false);
                  },
                  child: Text('Se déconnecter'),
                ),
              ],
            ),
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
