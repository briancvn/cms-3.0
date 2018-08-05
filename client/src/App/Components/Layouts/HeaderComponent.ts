import { ChangeDetectionStrategy, Component } from '@angular/core';

import { BaseComponent } from '../../../Infrastructure';

@Component({
  selector: 'header',
  templateUrl: 'Template/Infrastructure/Layouts/HeaderComponent.html',
  styleUrls: ['Styles/Infrastructure/Layouts/HeaderComponent.scss'],
  changeDetection: ChangeDetectionStrategy.OnPush
})
export class HeaderComponent extends BaseComponent { }