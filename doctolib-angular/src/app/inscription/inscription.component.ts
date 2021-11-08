import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { NgxSpinnerService } from 'ngx-spinner';
import { UserService } from '../common/user.service';

@Component({
  selector: 'app-inscription',
  templateUrl: './inscription.component.html',
  styleUrls: ['./inscription.component.css']
})
export class InscriptionComponent implements OnInit {

  form :{}
  emailForm:string
  passwordForm:string
  lastnameForm: string
  firstnameForm: string
  address_numForm: number
  address_streetForm: string
  postal_code_addressForm: number
  town_addressForm: string
  specialtyForm: string = null
  birth_dateForm: string = null
  profilInputForm: string
  erreur : string = null

  constructor(private spinnerService: NgxSpinnerService, private userService: UserService,  private router: Router) {

  }

  ngOnInit(): void {

  }

  inscription(){
    this.spinnerService.show()
    this.form={id:null,
      email:this.emailForm,
      password:this.passwordForm,
      lastname: this.lastnameForm,
      firstname: this.firstnameForm,
      address_num: this.address_numForm,
      address_street: this.address_streetForm,
      postal_code_address: this.postal_code_addressForm,
      town_address: this.town_addressForm,
      specialty: this.specialtyForm,
      birth_date: this.birth_dateForm,
      profil:'medecin'}
      this.userService.persistUser(this.form, this.profilInputForm).subscribe((response)=>{
        if(response.status == 201){
          this.spinnerService.hide();
          this.router.navigate([""])
        }
      })
    }
}
