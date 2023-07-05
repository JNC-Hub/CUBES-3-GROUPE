import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';
import 'affichageUtilisateur.dart';
import 'utilisateur.dart';
import 'package:image_picker/image_picker.dart';
import 'dart:io';
void main() {
  runApp(MyApp());
}
// point de départ de l'application
class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'My App',
      home: LoginCreationPage(),
    );
  }
}

class LoginCreationPage extends StatefulWidget {
  @override
  //créer l'objet d'état associé au widget LoginCreationPage( mettre à jour l'interface utilisateur de manière réactive)
  _LoginCreationPageState createState() => _LoginCreationPageState();
}

class _LoginCreationPageState extends State<LoginCreationPage> {
  //declartion des variables
  //Pour afficher/masquer password
  bool isPasswordVisible = false;
  bool isFormValid = true;
  // structure de données associant des clés à des valeurs.
  Map<String, dynamic>? data;
  bool isImageSelected = false;
  //gerer les champs de saisie(récupération valeurs)
  TextEditingController nomController = TextEditingController();
  TextEditingController prenomController = TextEditingController();
  TextEditingController emailController = TextEditingController();
  TextEditingController passwordController = TextEditingController();
  TextEditingController confirmPasswordController = TextEditingController();
  XFile? imageFile; // Nouvelle variable pour stocker le fichier d'image sélectionné de type xfile fournie par package dile-picker

  // Méthode pour sélectionner une image selon le paramétre w
  Future<void> pickImage(ImageSource media) async {
    //instancier classe  ImagePicker
    final picker = ImagePicker();
    final pickedFile = await picker.pickImage(source: media);

    if (pickedFile != null) {
      setState(() {
        isImageSelected = true;
        imageFile = pickedFile;
      });
    }
  }
  //le popup pour choisir de la galerie ou appareil photo
  void chooseImage() {
    //  afficher une boîte de dialogue modale
    showDialog(
        context: context,
        builder: (BuildContext context) {
          //AlertDialog: C'est un widget qui représente une boîte de dialogue
          return AlertDialog(
            //forme de la boite
            shape:
            RoundedRectangleBorder(borderRadius: BorderRadius.circular(8)),
            title: Text('Please choose media to select'),
            content: Container(
              height: MediaQuery
                  .of(context)
                  .size
                  .height / 6,
              child: Column(
                children: [
                  ElevatedButton(
                    // Si l'utilisateur clique sur ce bouton, il peut sélectionner une image depuis la galerie
                    onPressed: () {
                      Navigator.pop(context);
                      pickImage(ImageSource.gallery);
                    },
                    child: Row(
                      children: [
                        Icon(Icons.image),
                        Text('From Gallery'),
                      ],
                    ),
                  ),
                  ElevatedButton(
                    // Si l'utilisateur clique sur ce bouton, il peut capturer une image depuis la caméra
                    onPressed: () {
                      Navigator.pop(context);
                      pickImage(ImageSource.camera);
                    },
                    child: Row(
                      children: [
                        Icon(Icons.camera),
                        Text('From Camera'),
                      ],
                    ),
                  ),
                ],
              ),
            ),
          );
        });
  }
  Future<bool> createAccount() async {
    bool isSuccess = true;

    // Réinitialise l'état de validation
    setState(() {
      isFormValid = true;
    });

    // Vérification des mots de passe (si les 2 mdp soient identiques on affiche un pop up avec msg erreur)
    if (passwordController.text != confirmPasswordController.text) {
      setState(() {
        isFormValid = false;
      });
      showDialog(
        context: context,
        builder: (BuildContext context) {
          return AlertDialog(
            title: Text('Erreur'),
            content: Text('Les mots de passe ne correspondent pas.'),
            actions: [
              ElevatedButton(
                onPressed: () {
                  Navigator.of(context).pop();
                  // Effacer les champs de mot de passe
                  passwordController.clear();
                  confirmPasswordController.clear();
                },
                child: Text('OK'),
              ),
            ],
          );
        },
      );
      return false;
    }

    // Vérification des champs obligatoires
    if (nomController.text.isEmpty ||
        prenomController.text.isEmpty ||
        emailController.text.isEmpty ||
        passwordController.text.isEmpty ||
        confirmPasswordController.text.isEmpty) {
      setState(() {
        isFormValid = false;
      });
      return false;
    }

    // communication avec api avec un envoi des valeurs si le form is valide
    // var url = 'http://localhost/Code/apiFlutter/createLogin.php';
    var url = 'https://www.lesvoyageursgourmands.online/apiFlutter/createLogin.php';
    // les donnes à envoyer
    var requestBody = {
      'nom': nomController.text,
      'prenom': prenomController.text,
      'mail': emailController.text,
      'password': passwordController.text,
      'verifpassword': confirmPasswordController.text,
    };
    try {
      var response = await http.post(
        Uri.parse(url),
        headers: {'Content-Type': 'application/json'},
        body: jsonEncode(requestBody),
      );
      if (response.statusCode == 200) {
        data = jsonDecode(response.body);
        if (data?['message'] == 'Le mail existe déjà!') {
          showDialog(
            context: context,
            builder: (BuildContext context) {
              return AlertDialog(
                title: Text('Erreur'),
                content: Text(data?['message']),
                actions: [
                  ElevatedButton(
                    onPressed: () {
                      Navigator.of(context).pop();
                    },
                    child: Text('OK'),
                  ),
                ],
              );
            },
          );
          isSuccess = false;
        } else {
          print('Compte créé avec succès');
        }
      } else {
        // Échec de la création de compte
        print('Échec de la création de compte');
        isSuccess = false;
      }
    } catch (e) {
      // Erreur lors de la connexion à l'API
      print('Erreur de la connexion à l\'API : $e');
      isSuccess = false;
    }

    return isSuccess;
  }

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
                            controller: nomController,
                            textAlign: TextAlign.center,
                            decoration: InputDecoration(
                              labelText: 'Nom *',
                              suffixIcon: Text(
                                '*',
                                style: TextStyle(color: Colors.red),
                              ),
                            ),
                          ),
                        ),
                        SizedBox(height: 10),
                        Padding(
                          padding: EdgeInsets.only(left: 20, right: 20),
                          child: TextField(
                            controller: prenomController,
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
                            controller: emailController,
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
                            controller: passwordController,
                            textAlign: TextAlign.center,
                            obscureText: !isPasswordVisible,
                            decoration: InputDecoration(
                              labelText: 'Mot de passe *',
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
                        SizedBox(height: 10),
                        Padding(
                          padding: EdgeInsets.only(left: 20, right: 20),
                          child: TextField(
                            controller: confirmPasswordController,
                            textAlign: TextAlign.center,
                            obscureText: !isPasswordVisible,
                            decoration: InputDecoration(
                              labelText: 'Confirmation du mot de passe *',
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
                        SizedBox(height: 10),
                        // Champ d'upload d'image
                        ElevatedButton.icon(
                          onPressed: chooseImage,
                          icon: Icon(Icons.image),
                          label: Text('Sélectionnez une image'),
                        ),

                        SizedBox(height: 10),
                        //imageFile n'est pas nul
                        imageFile != null
                            ? Padding(
                          //définir des marges intérieures de 20 pixels
                              padding: const EdgeInsets.symmetric(horizontal: 20),
                              child: ClipRRect(
                                borderRadius: BorderRadius.circular(8),
                                child: Image.file(
                                  //pour afficher l'image à parttir du fichier local
                                  File(imageFile!.path),
                                  fit: BoxFit.cover,
                                  width: MediaQuery.of(context).size.width,
                                  height: 300,
                                ),
                              ),
                            )
                                : Text(
                              "Pas d'image",
                              style: TextStyle(fontSize: 20),
                            ),
                        ElevatedButton(
                          onPressed: () async {
                               bool  isCreated= await createAccount(); // Appelle la méthode createAccount()
                               //si l'utilsateur est créee avce succés
                                if (isCreated) {
                                  //naviger sans un autre page en envoyant les paramètres à aafficher
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
                              child: Text('Création de compte'),
                            ),
                      Visibility(
                        visible: !isFormValid,
                        child: Text(
                          'Veuillez remplir tous les champs obligatoires',
                          style: TextStyle(
                            color: Colors.red,
                          ),
                        ),
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
