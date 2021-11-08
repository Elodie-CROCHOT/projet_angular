import { HttpClient, HttpParams } from '@angular/common/http';
import { EventEmitter, Injectable } from '@angular/core';
import { Patient } from '../patients/patients/patient.model';

@Injectable({
  providedIn: 'root'
})
export class PatientService {

  selectPatient = new EventEmitter<any>()
  patients

    constructor(private http: HttpClient) {  }

  searchAllPatients(){
    return this.http.get<Patient[]>("http://localhost:8000/patients", {observe : 'response'})
  }

  emitSelectPatientById(id:number){
    this.selectPatient.emit(id);
  }

  getDetailPatientById(id: number){
    return this.http.get<Patient[]>("http://localhost:8000/patients/" + id, {observe : 'response'})
  }


}
