import { HttpClient } from '@angular/common/http';
import { EventEmitter, Injectable } from '@angular/core';
import { Rdv } from '../rdv/rdvs/rdv.model';

@Injectable({
  providedIn: 'root'
})
export class RdvService {
  selectRdv = new EventEmitter<any>()
  rdv

    constructor(private http: HttpClient) {  }

  searchAllRdv(){
    return this.http.get<Rdv[]>("http://localhost:8000/appointments", {observe : 'response'})
  }

  emitSelectRdvById(id:number){
    this.selectRdv.emit(id);
  }

  getDetailRdvById(id: number){
    return this.http.get<Rdv[]>("http://localhost:8000/appointments/" + id , {observe : 'response'})
  }

  deleteRdv(id: number){
    return this.http.delete<Rdv[]>("http://localhost:8000/appointments/" + id , {observe : 'response'})
  }
}
