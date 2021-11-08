import { Component, OnInit, Output } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from '../common/auth.service';
import { UserService } from '../common/user.service';

@Component({
  selector: 'app-connexion',
  templateUrl: './connexion.component.html',
  styleUrls: ['./connexion.component.css']
})
export class ConnexionComponent implements OnInit {

  emailForm:string
  passwordForm: string
  profilInputForm: string

  constructor(private userService: UserService, private router:Router, private authService: AuthService) { }


  ngOnInit(): void {
  }

  connexion(){
    this.userService.getUserByEmail(this.emailForm, this.passwordForm, this.profilInputForm).subscribe((response)=>{
      if(response.status == 200){
        this.authService.signIn()
        sessionStorage.setItem('email', this.emailForm)
        sessionStorage.setItem('profil', this.profilInputForm)
        if (this.profilInputForm == "Médecin") {
          this.router.navigate(["patients"])
        }
        else{
          this.router.navigate(["medecins"])
        }
      }
    })
  }

}
