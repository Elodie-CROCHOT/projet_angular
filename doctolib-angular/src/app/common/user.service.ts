import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Medecin } from '../medecins/medecins/medecin.model';
import { Patient } from '../patients/patients/patient.model';

@Injectable({
  providedIn: 'root'
})
export class UserService {

  medecins
  patients

  constructor(private http: HttpClient) { }


    getUserByEmail(email:string, password:string, profil:string){
      if(profil == "Médecin"){
        this.medecins=this.http.get<Medecin[]>("http://localhost:8000/doctors?email=" + email +"&password=" + password , {observe : 'response'})
        return this.medecins
      }
      if(profil == "Patient"){
        this.patients=this.http.get<Patient[]>("http://localhost:8000/patients?email=" + email +"&password=" + password , {observe : 'response'})
        return this.patients
      }
    }

    persistUser(form: {}, profil: string){
      if(profil == "Médecin"){
        this.medecins = this.http.post<Medecin[]>("http://localhost:8000/doctors", form, {observe: 'response'})
        return this.medecins
      }
      if(profil == "Patient"){
        this.patients = this.http.post<Patient[]>("http://localhost:8000/patients", form, {observe: 'response'})
        return this.patients
      }
    }


}
