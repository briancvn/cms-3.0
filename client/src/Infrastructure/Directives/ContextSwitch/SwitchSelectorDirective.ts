import { Directive, Input } from '@angular/core';
import { Observable } from 'rxjs/Observable';

import { BasicSwitchValue, SwitchValue } from '../../Models/ContextSwitch/SwitchValue';
import { ParentInjectorResolver } from '../../Services/ParentInjectorResolver';
import { SwitchSelectorBase } from './SwitchSelectorBase';
import { switchValueProvider } from './SwitchValueProvider';

@Directive({
    selector: '[switchSelector]',
    providers: [switchValueProvider, ParentInjectorResolver]
})
export class SwitchSelectorDirective extends SwitchSelectorBase {
    // tslint:disable-next-line:no-input-rename
    @Input('switchSelector') value: BasicSwitchValue;

    constructor(switchValue: SwitchValue) {
        super(switchValue);
    }

    protected calculateSwitchValue(): Observable<BasicSwitchValue> {
        return this.valuePropagator.asObservable();
    }

    protected get inputValue(): BasicSwitchValue {
        return this.value;
    }
}
