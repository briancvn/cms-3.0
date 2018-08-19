

import { Component } from '@angular/core';
import { LiveAnnouncer } from '@angular/cdk/a11y';

import { BaseComponent } from '../../Infrastructure';

@Component({
    selector: 'ui-sandbox',
    templateUrl: 'Template/Infrastructure/UISandboxComponent.html'
})
export class UISandboxComponent extends BaseComponent {
    constructor(liveAnnouncer: LiveAnnouncer) {
        super();
        liveAnnouncer.announce('Hey Google');
    }
}
