class Utilisateur {

  final int idUtilisateur;
  final String nom;
  final String prenom;
  final String mail;


  Utilisateur({
    required this.idUtilisateur,
    required this.nom,
    required this.prenom,
    required this.mail,
  });

  // Instance unique de la classe (pur variables globales)
  //static final SessionUtilisateur instance = SessionUtilisateur._privateConstructor();

}
