import { Component, Input, OnInit } from '@angular/core';
import { PatientService } from '../../common/patient.service';

@Component({
  selector: 'app-detail-patient',
  templateUrl: './detail-patient.component.html',
  styleUrls: ['./detail-patient.component.css']
})
export class DetailPatientComponent implements OnInit {

  patients
  @Input() patient


  constructor(private patientService: PatientService) {
    this.patientService.selectPatient.subscribe(lastname => {
      this.patientService.getDetailPatientById(lastname).subscribe((response) => {this.patients=response.body})
      })
  }

  ngOnInit(): void {
  }

}
