import { SwitchValue } from '../../Models/ContextSwitch/SwitchValue';
import { ParentInjectorResolver } from '../../Services/ParentInjectorResolver';

const switchValueFactory = (parentInjectorResolver: ParentInjectorResolver) => {
    return new SwitchValue(parentInjectorResolver.injector.get(SwitchValue));
};

export let switchValueProvider =  {
    provide: SwitchValue,
    useFactory: switchValueFactory,
    deps: [ParentInjectorResolver]
};
