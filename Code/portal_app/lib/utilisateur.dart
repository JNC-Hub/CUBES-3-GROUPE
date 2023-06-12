class Utilisateur {

  //Propriétés
  String? nom;
  String? prenom;
  String? mail;
  String? password;
  String? validationProfil;

  //Constructeur
  Utilisateur({
    this.nom, this.prenom, this.mail, this.password, this.validationProfil});

  // Instance unique de la classe (pur variables globales)
  //static final SessionUtilisateur instance = SessionUtilisateur._privateConstructor();

}
