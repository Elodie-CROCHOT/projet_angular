import { Component, Input, OnInit } from '@angular/core';
import { NgxSpinnerService } from 'ngx-spinner';
import { MedecinService } from 'src/app/common/medecin.service';

@Component({
  selector: 'app-liste-medecins',
  templateUrl: './liste-medecins.component.html',
  styleUrls: ['./liste-medecins.component.css']
})
export class ListeMedecinsComponent implements OnInit {

  listeMedecins

  @Input() medecins

  constructor(private medecinService: MedecinService, private spinnerService: NgxSpinnerService) { }

  ngOnInit(): void {
    this.spinnerService.show()
    this.medecinService.searchAllMedecins().subscribe( (response) => {
      this.listeMedecins=response.body
      console.log(sessionStorage.getItem('email'));
      this.spinnerService.hide()
    })
  }

  onSelectedMedecin(id: number){
    this.medecinService.emitSelectMedecinById(id)
  }

}
