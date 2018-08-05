import { ChangeDetectionStrategy, Component } from '@angular/core';

import { BaseComponent } from '../../../Infrastructure';

@Component({
  selector: 'footer',
  templateUrl: 'Template/Infrastructure/Layouts/FooterComponent.html',
  styleUrls: ['Styles/Infrastructure/Layouts/FooterComponent.scss'],
  changeDetection: ChangeDetectionStrategy.OnPush
})
export class FooterComponent extends BaseComponent { }