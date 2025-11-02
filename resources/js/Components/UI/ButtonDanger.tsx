import { Button, ButtonProps } from '@radix-ui/themes';
const ButtonDanger = (props: ButtonProps) => <Button color="red" {...props} />;

ButtonDanger.displayName = 'ButtonDanger';
export default ButtonDanger;
