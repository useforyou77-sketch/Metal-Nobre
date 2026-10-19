# Metal Nobre Joalheria

Site da **Metal Nobre Joalheria**: joias finas em ouro 18k teor 750, com autenticidade
e garantia eterna, há 20 anos no mercado. Cada peça abre o WhatsApp da loja com a foto junto.

## O que tem aqui

| Pasta / arquivo | O que é |
| --- | --- |
| `index.html` | O site (banner, coleção com filtros, história, atendimento e contato). |
| `dados.json` | As peças da coleção, as categorias e o número do WhatsApp. |
| `fotos/` | Fotos das peças e dos banners. |
| `painel.html` e `api/` | A Área da loja, com login e senha (funciona na Vercel). |
| `wordpress/metal-nobre/` | Tema WordPress com o mesmo visual e a loja em `/loja/`. |
| `wordpress/metal-nobre-tema-wordpress.zip` | O mesmo tema, pronto para instalar no WordPress. |

## Área da loja (na Vercel)

O site tem uma área com login e senha em **/painel** (link "Área da loja" no rodapé).
Nela você cadastra peças com foto, muda a ordem, exclui peças, troca as categorias e o
número do WhatsApp. Ao salvar, a área grava aqui no GitHub e a Vercel publica o site de
novo sozinha, em cerca de 1 minuto.

Para colocar no ar: entre em [vercel.com](https://vercel.com), clique em **Add New → Project**,
escolha este repositório e clique em **Deploy**.

Para a Área da loja funcionar, cadastre na Vercel, em **Settings → Environment Variables**:

| Nome | O que colocar |
| --- | --- |
| `ADMIN_USER` | O usuário da Área da loja (ex.: `julia`). |
| `ADMIN_PASSWORD` | A senha da Área da loja. |
| `SESSION_SECRET` | Um texto longo e aleatório (40 letras e números quaisquer). |
| `GITHUB_TOKEN` | Um token do GitHub com permissão de escrever neste repositório (veja abaixo). |

Depois de cadastrar, vá em **Deployments** e faça **Redeploy**.

**Como criar o `GITHUB_TOKEN`:** no GitHub, abra **Settings → Developer settings →
Personal access tokens → Fine-grained tokens → Generate new token**. Em **Repository access**
escolha **Only select repositories** e marque **Metal-Nobre**. Em **Permissions → Contents**
escolha **Read and write**. Gere o token, copie e cole na Vercel.

Para trocar usuário ou senha, mude `ADMIN_USER` e `ADMIN_PASSWORD` na Vercel e faça Redeploy.

## Editar sem a Área da loja

Também dá para abrir `dados.json` aqui no GitHub, clicar no lápis (Editar) e mudar as peças.
Fotos novas vão na pasta `fotos/`, com o caminho no campo `img` (ex.: `fotos/anel-novo.jpg`).

## Como usar o tema WordPress

No painel do WordPress, vá em **Aparência → Temas → Adicionar novo → Enviar tema**
e envie `wordpress/metal-nobre-tema-wordpress.zip`. Ao ativar, ele cria as 15 peças e as
categorias. As peças ficam no menu **Peças da loja**, e o WhatsApp em
**Aparência → Personalizar → Metal Nobre**.
