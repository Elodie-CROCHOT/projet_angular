import { Component, Input, OnInit } from '@angular/core';
import { NgxSpinnerService } from 'ngx-spinner';
import { RdvService } from 'src/app/common/rdv.service';

@Component({
  selector: 'app-liste-rdvs',
  templateUrl: './liste-rdvs.component.html',
  styleUrls: ['./liste-rdvs.component.css']
})
export class ListeRdvsComponent implements OnInit {

  listeRdvs

  @Input() rdvs

  constructor(private rdvService: RdvService, private spinnerService: NgxSpinnerService) { }

  ngOnInit(): void {
    this.spinnerService.show()
    this.rdvService.searchAllRdv().subscribe( (response) => {
      this.listeRdvs=response.body
    this.spinnerService.hide()
    })
  }

  onSelectedRdv(id: number){
    this.rdvService.emitSelectRdvById(id)
  }

}
