import { Component, Input, OnInit } from '@angular/core';
import { NgxSpinnerService } from 'ngx-spinner';
import { PatientService } from 'src/app/common/patient.service';

@Component({
  selector: 'app-liste-patients',
  templateUrl: './liste-patients.component.html',
  styleUrls: ['./liste-patients.component.css']
})
export class ListePatientsComponent implements OnInit {

  listePatients;

  @Input() patients

  constructor(private patientService: PatientService, private spinnerService: NgxSpinnerService) { }

  ngOnInit(): void {
    this.spinnerService.show()
    this.patientService.searchAllPatients().subscribe( (response) => {
      this.listePatients=response.body
      this.spinnerService.hide()
    })
  }

  onSelectedPatient(id: number){
    this.patientService.emitSelectPatientById(id)
  }

}
