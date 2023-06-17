import 'package:flutter/material.dart';
import 'utilisateur.dart';

class AffichageUtilisateurPage extends StatelessWidget {
  final Utilisateur utilisateur;

  AffichageUtilisateurPage({required this.utilisateur});

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
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Image.asset(
              'ressources/images/logoSite.png',
              width: 400,
              height: 400,
            ),
            SizedBox(height: 20),
            Text(
              'Bienvenue ${utilisateur.prenom} ${utilisateur.nom} !',
              style: TextStyle(fontSize: 24),
            ),
            SizedBox(height: 20),
            Text(
              'Votre email est : ${utilisateur.mail}',
              style: TextStyle(fontSize: 18),
            ),
            SizedBox(height: 20),
            ElevatedButton(
              onPressed: () {
                // Retour vers accueil et suppression données de navigation
                Navigator.of(context).pushNamedAndRemoveUntil('/', (route) => false);
              },
              child: Text('Se déconnecter'),
            ),
          ],
        ),
      ),
    );
  }
}