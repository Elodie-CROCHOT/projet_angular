import { HttpClient } from '@angular/common/http';
import { EventEmitter, Injectable } from '@angular/core';
import { NgForm } from '@angular/forms';
import { Medecin } from '../medecins/medecins/medecin.model';

@Injectable({
  providedIn: 'root'
})
export class MedecinService {

  selectMedecin = new EventEmitter<any>()
  medecins

    constructor(private http: HttpClient) {  }

  searchAllMedecins(){
    return this.http.get<Medecin[]>("http://localhost:8000/doctors", {observe : 'response'})
  }

  emitSelectMedecinById(id:number){
    this.selectMedecin.emit(id);
  }

  getDetailMedecinById(id: number){
    return this.http.get<Medecin[]>("http://localhost:8000/doctors/" + id , {observe : 'response'})
  }


}
