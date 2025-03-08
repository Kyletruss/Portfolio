import { IconButton as ChakraIconButton } from "@chakra-ui/react";
import * as React from "react";
import { LuX } from "react-icons/lu";

// ✅ Use ComponentProps<typeof ChakraIconButton> instead of ButtonProps
export type CloseButtonProps = React.ComponentProps<typeof ChakraIconButton>;

export const CloseButton = React.forwardRef<HTMLButtonElement, CloseButtonProps>(
  function CloseButton(props, ref) {
    return (
      <ChakraIconButton variant="ghost" aria-label="Close" ref={ref} {...props}>
        {/* {props.children ?? <LuX />} */}
      </ChakraIconButton>
    );
  }
);
